@extends('frontend.templates.layout')
    @section('content')
    <div class="col-md-12">
        <article class="blog-post">
            <div class="blog-post-body">
                <h2><a href="post.html">About Me</a></h2>
                <div class="blog-post-text">

                    <p>Welcome to My Blog! my name is Mohamad Muqiit Faturrahman, call me Muqiit or Fatur. I'm a student of Informatics Engineering in The National Institute of Technology in Bandung.
                    </p>
                    <img src="{{ asset('app/images/mine.jpg') }}" style="height: 400px" class="img-thumbnail mb-3">
                    <p>“The traditional methods used by researchers to analyze the relationship between the
                        activities of neurons were adopted from physics,” said Carina Curto, associate
                        professor of mathematics at Penn State, “but neuroscience data doesn’t necessarily
                        play by the same rules as data from physics, so we need new tools. Our method is a
                        first step toward developing a new mathematical toolkit to uncover the structure of
                        neural circuits with unknown function in the brain.”</p>

                    <h3>Math reveals structure in neural activity in the brain</h3>
                    <p>The method — clique topology — was developed by an interdisciplinary team of
                        researchers at Penn State, the University of Pennsylvania, the Howard Hughes Medical
                        Institute, and the University of Nebraska-Lincoln. The method is described in a
                        paper that will be posted in the early online edition of the journal Proceedings of
                        the National Academy of Sciences during the week ending October 23, 2015.</p>

                    <p>“We have adopted approaches from the field of algebraic topology that previously had
                        been used primarily in the domain of pure mathematics and have applied them to
                        experimental data on the activity of place cells — specialized neurons in the part
                        of the brain called the hippocampus that sense the position of an animal in its
                        environment,” said Curto.</p>
                </div>
            </div>
        </article>
    </div>
    @endsection